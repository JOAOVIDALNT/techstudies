import './InputForms.css'

const  InputForms = (props) => {
    const InputValue = (event) => {
        props.dataBiding(event.target.value)
    }


    return(
        <>
            <label>{props.label}</label>
            <input placeholder={props.placeholder} onChange={InputValue} value={props.value}/>
        </>
    )
}

export default InputForms