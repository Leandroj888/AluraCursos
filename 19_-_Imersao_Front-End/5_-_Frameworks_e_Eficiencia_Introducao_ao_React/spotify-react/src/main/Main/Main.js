import React from "react";
import "./Main.css"
import Header from '../Header/Header';
import Sidebar from '../../sidebar/Sidebar/Sidebar';
import Playlist from '../Playlist/Playlist';

const Main = () => {
    return (
        <main>
            <Sidebar/>
            <div className="main-container"> 
                <Header/>
                <Playlist/>
            </div>
        </main>
    );
}

export default Main;