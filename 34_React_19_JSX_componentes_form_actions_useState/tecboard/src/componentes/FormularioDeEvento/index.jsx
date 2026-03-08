import { CampoDeFormulario } from '../CampoDeFormulario'
import { TituloFormulario } from '../TituloFormulario'
import { ListaSuspensa } from '../ListaSuspensa'
import { Botao } from '../Botao'
import './formulario-evento.estilo.css'

//className é a forma correta de adicionar classes CSS em elementos HTML dentro do JSX, pois "class" é uma palavra reservada em JavaScript. O React usa "className" para evitar conflitos com a palavra reservada "class". Portanto, ao escrever código JSX, devemos usar "className" para atribuir classes CSS aos elementos HTML.
export function FormularioDeEvento({ temas, aoSubmeter }) {

  function aoFormSubbmetido(formData) {
    const dataEvento = formData.get("dataEvento");
    const evento = {
      capa: formData.get("urlCapaEvento"),
      tema: temas.find(t => t.id == formData.get("temaEvento")),
      data: dataEvento ? new Date(`${dataEvento}T00:00:00`) : null,
      titulo: formData.get("nomeEvento")
    }
    aoSubmeter(evento);
  }

  return (
    <form className="formulario-evento" action={aoFormSubbmetido}>
      <TituloFormulario>Preencha para criar um evento:</TituloFormulario>
      <div className="campos">
        <CampoDeFormulario label="Qual o nome do evento?" tipo="text" id="nomeEvento" placeholder='Summer dev hits'/>
        <CampoDeFormulario label="Qual o endereço da imagem de capa do evento?" tipo="text" id="urlCapaEvento" placeholder='https://exemplo.com/capa.jpg'/>
        <CampoDeFormulario label="Data do Evento?" tipo="date" id="dataEvento" placeholder='Summer dev hits'/>
        <ListaSuspensa label="Tema do Evento" id="temaEvento" itens={temas} />
      </div>
      <div className="acoes">
        <Botao className="botao">Criar evento</Botao>
      </div>
    </form>
  )
}
