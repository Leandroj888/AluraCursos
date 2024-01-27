import React from "react";
import "./Main.css"
import Header from '../Header/Header';
import Sidebar from '../../sidebar/Sidebar/Sidebar';
import Playlist from '../Playlist/Playlist';

const Main = () => {
    return (
        <main>
            <div className="main-container"> 
                <Sidebar/>
                <Header/>
                <Playlist/>
            </div>
        </main>
    );
}

export default Main;