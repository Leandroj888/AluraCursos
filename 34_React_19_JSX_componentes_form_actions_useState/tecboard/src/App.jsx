import './App.css'
import { FormularioDeEvento } from './componentes/FormularioDeEvento'
import { Tema } from './componentes/Tema'
import { Banner } from './componentes/Banner'
import { CardEvento } from './componentes/CardEvento'

function App() {

  const temas = [
    {
      id: 1,
      nome: 'front-end'
    }, 
    {
      id: 2,
      nome: 'back-end'
    },
    {
      id: 3,
      nome: 'devops'
    },
    {
      id: 4,
      nome: 'inteligência artificial'
    },
    {
      id: 5,
      nome: 'data science'
    },
    {
      id: 6,
      nome: 'cloud'
    }
  ]

  const eventos = [
    {
      capa: 'https://raw.githubusercontent.com/viniciosneves/tecboard-assets/refs/heads/main/imagem_1.png',
      tema: temas[0],
      data: new Date(),
      titulo: 'Mulheres no Front',
    },
  ]

  return (
    <main>
      <header>
        <img src="/logo.png" alt=""/>
      </header>
      <Banner />
      <FormularioDeEvento />
      {temas.map(tema => (
        <section key={tema.id}>
          <Tema tema={tema} />
          {eventos.filter(evento => evento.tema.id === tema.id).map(evento => (
            <CardEvento key={evento.titulo} evento={evento} />
          ))}
        </section>
      ))}
    </main>
  )
}

export default App
