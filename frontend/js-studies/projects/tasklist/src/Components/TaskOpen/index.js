import Button from '../Button'
import './TaskOpen.css'

const TaskOpen = (props) => {
    return(
        <section className='taskOpen'>
            <div className='sectionDiv'>

                <header>
                    <p className='servico' style={{backgroundColor: 'var(' + props.problemColor + ')', color: 'var(' + props.colorFont + ')'}}>
                        {props.problemTitle}
                    </p>

                    <div className='close' onClick={() => {props.cardTask('false')}}>
                        <div/>
                        <div/>
                    </div>
                </header>

                <ul>
                    <li>Nome do solicitante: {props.name}</li>
                    <li>Área do solicitante: {props.departamento}</li>
                    <li>Tipo da solicitação: {props.problemName}</li>
                    <li>Data da solicitação: {props.data}</li>
                    <li>Hora da solicitação: {props.hour}</li>
                    <li className='descricao'>Descrição:</li>
                    <li>{props.descricao}</li>

                </ul>

                <Button>Finalizado</Button>
            </div>
        </section>
    )
}

export default TaskOpen