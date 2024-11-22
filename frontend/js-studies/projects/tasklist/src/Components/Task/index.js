import './Task.css'

const Task = ({cardTask, name, problemColor, colorFont, problemTitle, data, descricao, departamento, problemName}) => {
    const filterCard = (event) =>{
        // event.preventDefault()

        cardTask('true');
        
        // filterCard({
        //     name, data, descricao
        // })
    }


    return(
        <div className="task" onClick={() => {filterCard()}}>
            <p className='problemTitle' style={{backgroundColor: 'var(' + problemColor + ')', color: 'var(' + colorFont + ')'}}>{problemTitle}</p>
            <p className='data'>{data}</p>
            <p className='descricao'>{descricao}</p>
            <p className='departamento'>{departamento}</p>
            <p className='line'>-</p>
            <p className='problemName'>{problemName}</p>
        </div>
    )
}

export default Task