import './SelectForms.css'

const SelectForms = (props) => {
    return(
        <>
            <label>{props.label}</label>
            <select onChange={event => props.dataBiding(event.target.value)} value={props.value}>
                <option hidden>{props.placeholder}</option>
                {props.options.map(option => <option key={option}>{option}</option>)}
            </select>
        </>
    )
}

export default SelectForms