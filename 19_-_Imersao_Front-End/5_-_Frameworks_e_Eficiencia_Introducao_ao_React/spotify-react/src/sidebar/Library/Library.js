import React from "react";

import "./Library.css";
import MenuButton from "../../util/MenuButton/MenuButton";
import Language from "../Language/Language";
import Cookies from "../Cookies/Cookies";
import Playlist from "../Playlist/Playlist";

/* eslint-disable jsx-a11y/anchor-is-valid */
const Library = () => {
    return (
        <div className="library">
            <div className="library__content">
                <MenuButton classButton="library__button" classImage="fa fas fa-book" text="Sua Biblioteca" />
                <span className="fa fa-plus"></span>
            </div>
            <Playlist/>
            <Cookies/>
            <Language/>
        </div>
    );
}

export default Library;