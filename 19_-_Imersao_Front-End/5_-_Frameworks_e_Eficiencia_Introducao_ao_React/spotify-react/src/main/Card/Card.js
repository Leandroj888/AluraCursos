import React from "react";
import "./Card.css"

/* eslint-disable jsx-a11y/anchor-is-valid */
const Card = ({identifier, className, image, style}) => {
    return (
        <a key={identifier} id={identifier} href="" className="cards">
            <div className={className}>
                <img src={image} alt="" />
                <span>{style}</span>
            </div>
        </a>
    );
}

export default Card;