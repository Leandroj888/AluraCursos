import React from "react";
import "./MenuButton.css"

const MenuButton = ({classButton, classImage, text}) => {
    var FontAwesome = "";
    var TextElement = "";
    
    if (classImage !== undefined) {
        FontAwesome = <span className={`menuButton__image ${classImage}`}></span>;
    }
    if (text !== undefined) {
        TextElement = <span>{text}</span>;
    }
    
    return (
        <button className={`menuButton ${classButton}`}>
            {FontAwesome}
            {TextElement}
        </button>
    );
}

export default MenuButton;