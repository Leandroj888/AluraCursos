<?php

class MeuFiltro extends php_user_filter
{
    public $stream;
    
    // Será executado quando criar a instância - construtor
    public function onCreate(): bool
    {
        // gera um espaço em mémoria ram pra trabalhar com um arquivo
        $this->stream = fopen('php://temp','w+');
        return $this->stream !== false;
    }
    
    //realmente manipula os valores
    public function filter($in, $out, &$consumed, bool $closing): int
    {
        $saidas = "";
        // bucket igual a parte do arquivo - na função a seguir pega todos os pedaços de arquivos
        while ($bucket = stream_bucket_make_writeable($in)) {
            if ($closing && !$bucket->datalen) {
                // Pedir para o PHP mais partes do arquivo
                return PSFS_FEED_ME;
            }
            // Informa para o php o quanto já leu do arquivo
            $consumed += $bucket->datalen;
            
            // caso tiver contéudo temporário resgata ele e agrega ao bucket lido
            $stringFromBucket = $bucket->data;
            if (!empty($this->stream)) {
                $stringFromBucket = $this->stream . $bucket->data;
                $this->stream = null;
            }

            //Nesse caso valida se o bucket termina com quebra de linha,
            // caso não armazena o bucket lido na memória e solicita mais buckets para o php
            if ($stringFromBucket[-1] !== "\n") {
                $this->stream = $stringFromBucket;
                return PSFS_FEED_ME;
            }
            
            //$bucket->data = string
            //$bucket->datalen = tamanho da string  
            $linhas = explode("\n", $stringFromBucket);
            foreach ($linhas as $linha) {
                if (stripos($linha, "parte")) {
                    $saidas .= "$linha\n";
                }
            }
        }
        // Cria um bucket para saida
        $bucketSaida = stream_bucket_new($this->stream, $saidas);
        // Adiciona o bucket para retorno da função
        stream_bucket_append($out, $bucketSaida);
        
        // retorna que tudo ocorreu bem;
        return PSFS_PASS_ON;
    }
    
    // Será executado quando finalizar a instância - desconstrutor
    public function onClose(): void
    {
        parent::onClose();
    }
}