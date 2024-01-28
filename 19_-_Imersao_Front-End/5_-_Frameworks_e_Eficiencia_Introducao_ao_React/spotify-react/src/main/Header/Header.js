import React from "react"; // Declarando que esse js é um componente
import "./Header.css"; // Indica qual vai ser o css utilizado
import "./media-queries.css";

import search from "../../assets/icons/search.png";
import MenuButton from "../../util/MenuButton/MenuButton";

const Header = () => {
    return(
        <nav className="header__navigation">
            <div className="navigation">
                <MenuButton classButton="arrow" classImage="fa fa-chevron-left"/>
                <MenuButton classButton="arrow" classImage="fa fa-chevron-right"/>
            </div>
            <div className="header__search">
                <img src={search} alt=""/>
                <input id="search-input" type="text" maxLength="800" placeholder="O que você quer ouvir?"/>
            </div>
            <div className="header__login">
                <MenuButton classButton="subscribe" text="Inscreva-se"/>
                <MenuButton classButton="login" text="Entrar"/>
            </div>
        </nav>
    );
};

export default Header;