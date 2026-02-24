import './lista-suspensa.estilo.css'
import { Label } from '../Label'

export function ListaSuspensa({label}) {
    return (
        <>
            <Label>{label}</Label>
            <select className='lista-suspensa-form'>
                <option value=""></option>
            </select>
        </>
    )
}   