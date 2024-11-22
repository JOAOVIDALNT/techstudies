import { useState } from 'react'
import Button from '../Button'
import InputForms from '../InputForms'
import SelectForms from '../SelectForms'
import TextArea from '../TextArea'
import './Forms.css'

const Forms = (props) => {
    
    const [name, setName] = useState('')
    const [departamento, setDepartamento] = useState('')
    const [problem, setProblem] = useState('')
    // const [typeProblem, setTypeProblem] = useState('')
    // const [dateProblem, setDateProblem] = useState('')
    const [detalhes, setDetalhes] = useState('')

    const positionArray = props.problemTitle.findIndex(i => i.problemName === problem)

    const today = new Date();
    const dd = String(today.getDate()).padStart(2, '0');
    const mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
    const yyyy = today.getFullYear();

    const day = dd + '/' + mm + '/' + yyyy;

    function addZero(i) {
        if (i < 10) {i = "0" + i}
        return i;
    }
    
    const d = new Date();
    const h = addZero(d.getHours());
    const m = addZero(d.getMinutes());
    const time = h + ":" + m;
    
    const DataSave = (event) =>{
        event.preventDefault()

        const typeProblem = positionArray
        const dateProblem = day
        const hourProblem = time
        
        props.sendValues({
            name: name,
            departamento: departamento,
            problem: problem,
            typeProblem: typeProblem,
            dateProblem: dateProblem,
            hourProblem: hourProblem,
            detalhes:detalhes
        })
        setName('')
        setDepartamento('')
        setProblem('')
        setDetalhes('')
    }

    return(
        <section className='formsBox'>
            <h1>{props.title}</h1>

            <form onSubmit={DataSave}>
                <InputForms 
                    label='Nome:' 
                    placeholder='Coloque seu nome'
                    value={name}
                    dataBiding={value => setName(value)}
                />

                <SelectForms
                    label='Departamento:'
                    placeholder='Selecione seu departamento'
                    options={props.departamentos}
                    value={departamento}
                    dataBiding={value => setDepartamento(value)}
                />

                <SelectForms
                    label='Tipo do problema:'
                    placeholder='Selecione seu problema'
                    options={props.problems}
                    value={problem}
                    dataBiding={value =>setProblem(value)}
                />

                <TextArea
                    label='Detalhes:'
                    rows='4'
                    cols='30'
                    value={detalhes}
                    dataBiding={value =>setDetalhes(value)}
                />

                <Button>Enviar solicitação</Button>
            </form>
        </section>
    )
}

export default Forms