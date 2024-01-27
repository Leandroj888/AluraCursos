//import logo from './logo.svg';
//import './App.css';

import './reset.css';
import './var.css';
import Footer from './Footer/Footer';
import Main from './Main/Main';
import Script from "./scripts.js";

const solid = "https://use.fontawesome.com/releases/v5.15.4/css/solid.css";
const solidIntegration = "sha384-Tv5i09RULyHKMwX0E8wJUqSOaXlyu3SQxORObAI08iUwIalMmN5L6AvlPX2LMoSE";
const fontawesome = "https://use.fontawesome.com/releases/v5.15.4/css/fontawesome.css";
const fontawesomeIntegration = "sha384-jLKHWM3JRmfMU0A5x5AkjWkw/EYfGUAGagvnfryNV3F9VqM98XiIH7VBGVoxVSc7";

function App() {    
    return (
        <html>
            <head>
                <link rel="stylesheet" href={solid} integrity={solidIntegration} crossorigin="anonymous" />
                <link rel="stylesheet" href={fontawesome} integrity={fontawesomeIntegration} crossorigin="anonymous" />
            </head>
            <body>
                <Main/>
                <Footer/>
                <script type="text/javascript" src={Script}></script>
            </body>
        </html>
        /*
        <div className="App">
            <header className="App-header">
                <img src={logo} className="App-logo" alt="logo" />
                <h2>Imersão Front-End Alura 2024</h2>
                <p>
                    Edit <code>src/App.js</code> and save to reload.
                </p>
                <a
                    className="App-link"
                    href="https://reactjs.org"
                    target="_blank"
                    rel="noopener noreferrer"
                >
                    Learn React
                </a>
            </header>
        </div>
        */
    );
}

export default App;
