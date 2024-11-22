import { useEffect, useState } from 'react';
import './App.css';
import AsideCards from './Components/AsideCards';
import Forms from './Components/Forms';
import NavAside from './Components/NavAside';
import TaskList from './Components/TaskList';

function App() {

  const ProblemsType = [
    {
      problemTitle: 'Serviços',
      problemName: 'Internet',
      problemColor: '--blue-logo',
      colorFont: '--white'
    },
    {
      problemTitle: 'Serviços',
      problemName: 'Voip',
      problemColor: '--blue-logo',
      colorFont: '--white'
    },
    {
      problemTitle: 'Serviços',
      problemName: 'Telefone - Serviço',
      problemColor: '--blue-logo',
      colorFont: '--white'
    },
    {
      problemTitle: 'Equipamento',
      problemName: 'Telefone - Equipamento',
      problemColor: '--orange-logo',
      colorFont: '--black'
    },
    {
      problemTitle: 'Equipamento',
      problemName: 'Impressora',
      problemColor: '--orange-logo',
      colorFont: '--black'
    },
    {
      problemTitle: 'Equipamento',
      problemName: 'Computador',
      problemColor: '--orange-logo',
      colorFont: '--black'
    },
    {
      problemTitle: 'Equipamento',
      problemName: 'Coletor',
      problemColor: '--orange-logo',
      colorFont: '--black'
    },
    {
      problemTitle: 'Equipamento',
      problemName: 'Leitores',
      problemColor: '--orange-logo',
      colorFont: '--black'
    },
    {
      problemTitle: 'Periféricos',
      problemName: 'Mouse',
      problemColor: '--green-logo',
      colorFont: '--black'
    },
    {
      problemTitle: 'Periféricos',
      problemName: 'Teclado',
      problemColor: '--green-logo',
      colorFont: '--black'
    },
    {
      problemTitle: 'Periféricos',
      problemName: 'Monitor',
      problemColor: '--green-logo',
      colorFont: '--black'
    },
    {
      problemTitle: 'Sistema',
      problemName: 'Sistema com Lentidão',
      problemColor: '--purple-logo',
      colorFont: '--white'
    },
    {
      problemTitle: 'Sistema',
      problemName: 'Sistema Offline',
      problemColor: '--purple-logo',
      colorFont: '--white'
    },
  ]

  const Departamento = [
    {
      Departamento: 'Recepção'
    },
    {
      Departamento: 'RH'
    },
    {
      Departamento: 'Design'
    },
    {
      Departamento: 'Comercial'
    },
    {
      Departamento: 'Marketing'
    },
    {
      Departamento: 'Logistica'
    },
    {
      Departamento: 'Administração'
    },
    {
      Departamento: 'Financeiro'
    },
    {
      Departamento: 'Importação'
    },
    {
      Departamento: 'E-commerce'
    },
  ]

  const StatusList = [
    {
      status: 'Finalizado'
    },
    {
      status: 'Aberto'
    }
  ]

  const [valueCard, setValueCard] = useState([])

  const addProblemCard = (valuesCard) => {
    setValueCard([...valueCard, valuesCard])
    console.log(valuesCard)
  }

  const [filtering, setFiltering] = useState([])

  const filter = (valuesfilter) => {
    setFiltering([...filtering, valuesfilter])
    console.log(valuesfilter)
  }

  const [dashboard, setDashboard] = useState(false);

  useEffect(
    () => {  
      console.log(dashboard);
    }, [dashboard]
  )

  return (
    <>
      <NavAside
        handler={setDashboard}
      />

      {dashboard === 'true'  ? 

        (
          <section className='dashboard'>
            <Forms 
              title='Qual o problema?'
              problemTitle={ProblemsType}
              problems={ProblemsType.map(problem => problem.problemName)}
              departamentos = {Departamento.map(departamento => departamento.Departamento)}
              sendValues={valuesCard => addProblemCard(valuesCard)}
            />

            <AsideCards
              valuesCard={valueCard}
              problems={ProblemsType}
            />

          </section>
        )
        
        :
        
        (
          <TaskList
            problems={ProblemsType.map(problem => problem.problemName)}
            departamentos = {Departamento.map(departamento => departamento.Departamento)}
            status = {StatusList.map(status => status.status)}
            valuesCard={valueCard}
            problem={ProblemsType}
            filtering={valuesfilter => filter(valuesfilter)}
          />
        )
      }
    </>
  );
}

export default App;
