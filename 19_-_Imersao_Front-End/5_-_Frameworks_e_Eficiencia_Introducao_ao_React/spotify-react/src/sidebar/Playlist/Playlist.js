import React from "react";
import "./Playlist.css";
import MenuButton from "../../util/MenuButton/MenuButton";

const Playlist = (props) => {
    return (
        <section className="section-playlist">
            <div className="section-playlist__content">
                <span className="text title">Crie sua primeira playlist</span>
                <span className="text subtitle">É fácil, vamos te ajudar</span>                    
                <MenuButton classButton="section-playlist__button" text="Criar playlist" />
            </div>
        </section>
    );
};

export default Playlist;