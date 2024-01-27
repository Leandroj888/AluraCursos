//import logo from './logo.svg';
//import './App.css';

import React, { Component } from 'react';
import './var.css';
import Footer from './footer/Footer/Footer';
import Main from './main/Main/Main';
import Script from "./search.js";

class App extends Component {    
    componentDidMount() {
        <div>
            <script type="text/javascript" src={Script}></script>
        </div>
    }

    render() {
        return (
            <div>
                <Main />
                <Footer />
            </div>
        );
    }
}

export default App;
