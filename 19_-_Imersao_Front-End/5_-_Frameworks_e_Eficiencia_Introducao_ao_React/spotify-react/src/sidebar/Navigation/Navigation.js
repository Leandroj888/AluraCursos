import React from "react";

import logo from "../../assets/icons/logo-spotify.png";
import "./Navigation.css";
import MenuButton from "../../util/MenuButton/MenuButton";

/* eslint-disable jsx-a11y/anchor-is-valid */
const Navigation = () => {
    return (
        <nav className="sidebar__navigation">
            <div className="logo">
                <a href="">
                    <img src={logo} alt="Logo do Spotify"/>
                </a>
            </div>
            <ul>
                <li>
                    <MenuButton classButton="" classImage="fa fa-home" text="Início" />
                </li>
                <li>
                    <MenuButton classButton="" classImage="fa fa-search" text="Buscar" />
                </li>
            </ul>
        </nav>
    );
}

export default Navigation;