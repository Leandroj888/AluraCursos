import './label.estilo.css'

export function Label({htmlFor, children}) {
  return (
    <label className='label' htmlFor={htmlFor}>{children}</label>
  )
}
