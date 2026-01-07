package com.alura.pix.consumidor;

import com.alura.pix.avro.PixRecord;
import com.alura.pix.dto.PixDTO;
import com.alura.pix.dto.PixStatus;
import com.alura.pix.exception.KeyNotFoundException;
import com.alura.pix.model.Key;
import com.alura.pix.model.Pix;
import com.alura.pix.repository.KeyRepository;
import com.alura.pix.repository.PixRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.kafka.annotation.KafkaListener;
import org.springframework.kafka.annotation.RetryableTopic;
import org.springframework.kafka.support.Acknowledgment;
import org.springframework.retry.annotation.Backoff;
import org.springframework.stereotype.Service;

@Service // Anotação spring para criar um serviço autoinstanciado
public class PixValidator {

    @Autowired
    private KeyRepository keyRepository;

    @Autowired
    private PixRepository pixRepository;

    @KafkaListener(topics = "pix-topic", groupId = "grupo")
    @RetryableTopic(backoff = @Backoff(value = 3000L), attempts = "5", autoCreateTopics = "true", include = KeyNotFoundException.class) // Parametrização das tentativa em caso de erro.
    public void processaPix(PixRecord pixRecord) { // serviço do kafka precisa ser public void e deve receber por parâmetro o mesmo dto enviado
 // public void processaPix(PixDTO pixDTO) { // serviço do kafka precisa ser public void e deve receber por parâmetro o mesmo dto enviado
 // public void processaPix(PixDTO pixDTO, Acknowledgment acknowledgment)
        System.out.println("Pix  recebido: " + pixRecord.getIdentificador());

        Pix pix = pixRepository.findByIdentifier(pixRecord.getIdentificador());

        Key origem = keyRepository.findByChave(pixRecord.getChaveOrigem());
        Key destino = keyRepository.findByChave(pixRecord.getChaveDestino());

        if (origem == null || destino == null) {
            pix.setStatus(PixStatus.ERRO);
            throw new KeyNotFoundException();
        } else {
            pix.setStatus(PixStatus.PROCESSADO);
        }
        pixRepository.save(pix);
        //acknowledgment.acknowledge(); // faz o commit da mensagem do kafka
    }

}
