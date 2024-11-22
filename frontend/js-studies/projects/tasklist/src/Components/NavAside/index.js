import './NavAside.css'
import {ReactComponent as Logo} from '../../img/logo-nybc.svg'
import iconDashboard from '../../img/dashboard.svg'
import iconTaskList from '../../img/fileCopy.svg'
import ComponentNav from '../ComponentNav'

const NavAside = (props) => {
    return(
        <aside className='navBar'>
            <Logo className='logo'/>

            <ComponentNav src={iconDashboard} title='Dashboard' handler={props.handler} type='true'/>
            <ComponentNav src={iconTaskList} title='Task list' handler={props.handler} type='false'/>

            <div className='dataClient'>
                <p>Nome do Fulano Ciclano</p>
                <p>Área do fulano</p>
            </div>
        </aside>
    )
}

export default NavAside