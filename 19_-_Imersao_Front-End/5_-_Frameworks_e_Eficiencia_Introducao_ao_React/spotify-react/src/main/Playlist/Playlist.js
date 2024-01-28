/* eslint-disable jsx-a11y/anchor-is-valid */
/* eslint-disable jsx-a11y/alt-text */
import React from "react";
import "./Playlist.css";
import Greeting from "../Greeting/Greeting";
import Artist from "../Artist/Artist";

const Playlist = () => {    
    return (
        <div className="playlist-container">
            <div className="playlist-elements">
                <Greeting/>
                <Artist/>
            </div>
        </div>
    );
};

export default Playlist;