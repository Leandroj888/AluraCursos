import './card_evento.estilo.css'

export function CardEvento({ evento }) {
    const dataFormatada = (() => {
        if (!evento.data) return '';
        const data = evento.data instanceof Date ? evento.data : new Date(`${evento.data}T00:00:00`);
        return Number.isNaN(data.getTime()) ? '' : data.toLocaleDateString('pt-BR');
    })();

    return (
        <div className='card-evento'>
            <img src={evento.capa} alt={evento.titulo} className='capa-evento'/>
            <div className='corpo'>
                <p className='tag'>{evento.tema.nome}</p>
                <p className='data'>{dataFormatada}</p>
                <h4 className='titulo'>{evento.titulo}</h4>
            </div>
        </div>
    )
}
