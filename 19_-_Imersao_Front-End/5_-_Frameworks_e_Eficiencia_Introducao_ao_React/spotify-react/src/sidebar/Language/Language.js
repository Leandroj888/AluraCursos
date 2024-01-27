import React from "react";
import "./Language.css";
import MenuButton from "../../util/MenuButton/MenuButton";

const Language = (props) => {
    return (
        <div className="languages">
            <MenuButton classButton="languages__button" classImage="fa fa-globe" text="Português do Brasil" />
        </div>
    );
};

export default Language;