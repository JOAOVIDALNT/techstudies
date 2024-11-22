import { useEffect, useState } from 'react';
import Task from '../Task'
import './AsideCards.css'

const AsideCards = ({valuesCard, problems}) => {

    const [cardTask, setCardTask] = useState('false');

    useEffect(
        () => {  
        console.log(cardTask);
        }, [cardTask]
    )

    return(
        <aside className='asideCards'>
            <h3>Em aberto</h3>

                {valuesCard.map(valueCard => 
                    <Task
                        key={valueCard.name}
                        problemTitle={problems[valueCard.typeProblem].problemTitle}
                        problemColor={problems[valueCard.typeProblem].problemColor}
                        colorFont={problems[valueCard.typeProblem].colorFont}
                        data={valueCard.dateProblem}
                        descricao={valueCard.detalhes}
                        departamento={valueCard.departamento}
                        problemName={valueCard.problem}
                        cardTask={setCardTask}
                    />
                )}

        </aside>
       
    )
}

export default AsideCards