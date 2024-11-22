import './ComponentNav.css'

const ComponentNav = (props) => {

    return(
        <div className='componentNav' onClick={() => {props.handler(props.type)}}>
            <img src={props.src} alt={'ícone ' + props.title}></img>

            <p>{props.title}</p>
        </div>
    )
}

export default ComponentNav