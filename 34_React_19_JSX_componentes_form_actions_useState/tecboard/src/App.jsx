import './App.css'
import { FormularioDeEvento } from './componentes/FormularioDeEvento'
import { Tema } from './componentes/Tema'
import { Banner } from './componentes/Banner'
import { CardEvento } from './componentes/CardEvento'
import { useState } from 'react'

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

  const [eventos, setEventos] = useState([
    {
      capa: 'https://raw.githubusercontent.com/viniciosneves/tecboard-assets/refs/heads/main/imagem_1.png',
      tema: temas[0],
      data: new Date(),
      titulo: 'Mulheres no Front',
    }
  ])

  function adicionarEvento(evento) {
    setEventos([...eventos, evento]);
  }

  // renderização condicional usando &&
  /*
        {temas.map(function (tema) {
          return eventos.some(evento => evento.tema.id === tema.id) && (
            <section key={tema.id}>
              <Tema tema={tema} />
              <div className="eventos">
                {eventos.filter(evento => evento.tema.id === tema.id).map((evento, index) => (
                  <CardEvento key={index} evento={evento} />
                ))}
              </div>
            </section>
        )})}
*/

  return (
    <main>
      <header>
        <img src="/logo.png" alt=""/>
      </header>
      <Banner />
      <FormularioDeEvento temas={temas} aoSubmeter={adicionarEvento} />
      <section className='container'>
        {temas.map(function (tema) {
          if (!eventos.some(evento => (evento.tema.id == tema.id))) {
            return null
          }

          return (
            <section key={tema.id}>
              <Tema tema={tema} />
              <div className="eventos">
                {eventos.filter(evento => evento.tema.id === tema.id).map((evento, index) => (
                  <CardEvento key={index} evento={evento} />
                ))}
              </div>
            </section>
          )
        })}
      </section>
    </main>
  )
}

export default App
