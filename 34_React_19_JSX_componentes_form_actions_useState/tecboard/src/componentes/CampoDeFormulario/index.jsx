import { Label } from '../Label'
import { CampoDeEntrada } from '../CampoDeEntrada'
import './campo-formulario.estilo.css'


// Para melhorar podemos desestruturar as props, ou seja, extrair as propriedades do objeto props para variáveis individuais. Isso torna o código mais legível e fácil de entender. No exemplo abaixo, o componente CampoDeFormulario recebe as propriedades "label", "tipo", "id" e "placeholder", que são usadas para criar um campo de formulário.
export function CampoDeFormulario({label, tipo, id, placeholder}) {
  return (
    <fieldset className="campo-form">
      <Label htmlFor={id}>{label}</Label>
      <CampoDeEntrada type={tipo} id={id} name={id} placeholder={placeholder}/>
    </fieldset>
  )
}