import './TextArea.css'

const TextArea = (props) => {
    return(
        <>
            <label>{props.label}</label>
            <textarea rows={props.rows} cols={props.cols} onChange={event => props.dataBiding(event.target.value)} value={props.value}/>
        </>
    )
}

export default TextArea