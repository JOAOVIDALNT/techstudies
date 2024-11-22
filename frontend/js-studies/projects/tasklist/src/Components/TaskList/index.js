import { useEffect, useState } from 'react'
import SelectForms from '../SelectForms'
import Button from '../Button'
import './TaskList.css'
import Task from '../Task'
import TaskOpen from '../TaskOpen'

const TaskList = (props) => {

    const [departamentoFilter, setDepartamentoFilter] = useState('')
    const [problemFilter, setProblemFilter] = useState('')
    const [statusFilter, setstatusFilter] = useState('')

    const Filtering = (event) =>{
        event.preventDefault()

        props.filtering({
            departamentoFilter: departamentoFilter,
            problemFilter: problemFilter,
            statusFilter: statusFilter
            
        })
        setDepartamentoFilter('')
        setProblemFilter('')
        setstatusFilter('')
    }

    const [cardTask, setCardTask] = useState('false');

    useEffect(
        () => {  
        console.log(cardTask);
        }, [cardTask]
    )

    const [filterCard, setFilterCard] = useState('');

    useEffect(
        () => {  
        console.log(filterCard);
        }, [filterCard]
    )
        console.log(setFilterCard)
        console.log(props.valuesCard.filter(i => i.name==='Carol'))

    return(
        <section className='taskList'>
            <form onSubmit={Filtering} className='filtering'>
                <SelectForms
                    label=''
                    placeholder='Tipo do problema'
                    options={props.problems}
                    value={problemFilter}
                    dataBiding={value => setProblemFilter(value)}
                />
                <SelectForms
                    label=''
                    placeholder='Departamento do problema'
                    options={props.departamentos}
                    value={departamentoFilter}
                    dataBiding={value => setDepartamentoFilter(value)}
                />

                <SelectForms
                    label=''
                    placeholder='Status do problema'
                    options={props.status}
                    value={statusFilter}
                    dataBiding={value => setstatusFilter(value)}
                />

                <Button>Filtrar</Button>
            </form>

            <section className='tasks'>
                {props.valuesCard.map(valueCard => 
                        <>
                            <Task
                                key={valueCard.name + valueCard.dateProblem + valueCard.detalhes}
                                problemTitle={props.problem[valueCard.typeProblem].problemTitle}
                                problemColor={props.problem[valueCard.typeProblem].problemColor}
                                colorFont={props.problem[valueCard.typeProblem].colorFont}
                                data={valueCard.dateProblem}
                                descricao={valueCard.detalhes}
                                departamento={valueCard.departamento}
                                problemName={valueCard.problem}
                                filterCard={setFilterCard}
                                cardTask={setCardTask}
                            />

                            {cardTask === 'true'  ? 
                                
                                (
                                    <TaskOpen
                                        key={valueCard.name + valueCard.dateProblem + valueCard.detalhes + 'card'}
                                        name={valueCard.name}
                                        problemTitle={props.problem[valueCard.typeProblem].problemTitle}
                                        problemColor={props.problem[valueCard.typeProblem].problemColor}
                                        colorFont={props.problem[valueCard.typeProblem].colorFont}
                                        data={valueCard.dateProblem}
                                        hour={valueCard.hourProblem}
                                        descricao={valueCard.detalhes}
                                        departamento={valueCard.departamento}
                                        problemName={valueCard.problem}
                                        filterCard={setFilterCard}
                                        cardTask={setCardTask}
                                    />
                                ): ''
                            }
                        
                        </>
                )}
            </section>


            
        </section>
    )
}

export default TaskList