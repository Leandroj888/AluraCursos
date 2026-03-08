import './lista-suspensa.estilo.css'
import { Label } from '../Label'

export function ListaSuspensa({id, label, itens = []}) {
    return (
        <>
            <Label htmlFor={id}>{label}</Label>
            <select className='lista-suspensa-form' id={id} name={id} defaultValue="">
                <option value="" disabled>Selecione uma Opção</option>
                {itens.map(item => (
                    <option key={item.id} value={item.id}>
                        {item.nome}
                    </option>
                ))}
            </select>
        </>
    )
}   
