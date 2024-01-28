/* eslint-disable jsx-a11y/anchor-is-valid */
/* eslint-disable jsx-a11y/alt-text */
import React from "react";
import "./Greeting.css";
import "./media-queries.css";

import img1 from "../../assets/playlist/1.jpeg";
import img2 from "../../assets/playlist/2.png";
import img3 from "../../assets/playlist/3.jpeg";
import img4 from "../../assets/playlist/4.jpeg";
import img5 from "../../assets/playlist/5.jpeg";
import img6 from "../../assets/playlist/6.jpeg";
import img7 from "../../assets/playlist/7.jpeg";
import img8 from "../../assets/playlist/8.jpeg";
import img9 from "../../assets/playlist/9.jpeg";
import img10 from "../../assets/playlist/10.jpeg";
import img11 from "../../assets/playlist/11.jpeg";
import img12 from "../../assets/playlist/12.jpeg";
import img13 from "../../assets/playlist/13.jpeg";
import img14 from "../../assets/playlist/14.jpeg";
import img15 from "../../assets/playlist/15.jpeg";
import Card from "../Card/Card";


const cards = [
    { identifier:"card1", class: "cards card1", image:img1, style:"Boas festas"},
    { identifier:"card2", class: "cards card2", image:img2, style:"Feitos para você"},
    { identifier:"card3", class: "cards card3", image:img3, style:"Lançamentos"},
    { identifier:"card4", class: "cards card4", image:img4, style:"Creators"},
    { identifier:"card5", class: "cards card5", image:img5, style:"Para treinar"},
    { identifier:"card6", class: "cards card6", image:img6, style:"Podcasts"},
    { identifier:"card7", class: "cards card7", image:img7, style:"Sertanejo"},
    { identifier:"card8", class: "cards card8", image:img8, style:"Samba e pagode"},
    { identifier:"card9", class: "cards card9", image:img9, style:"Funk"},
    { identifier:"card10", class: "cards card10", image:img10, style:"MPB"},
    { identifier:"card11", class: "cards card11", image:img11, style:"Rock"},
    { identifier:"card12", class: "cards card12", image:img12, style:"Hip Hop"},
    { identifier:"card13", class: "cards card13", image:img13, style:"Indie"},
    { identifier:"card14", class: "cards card14", image:img14, style:"Relax"},
    { identifier:"card15", class: "cards card15", image:img15, style:"Música Latina"}
];

const Greeting = () => {
    const currentHour = new Date().getHours();
    const greeting = currentHour >= 5 && currentHour < 12 
        ? "Bom dia"
        : currentHour >= 12 && currentHour < 18
            ? "Boa tarde"
            : "Boa noite";
    
    return (
        <div id="result-playlists">
            <div className="playlist">
                <h1 id="greeting">{greeting}</h1>
                <h2 className="session">Navegar por todas as seções</h2>
            </div>
            <div className="offer__scroll-container">
                <div className="offer__list">
                    <section className="offer__list-item">
                        {cards.map((card) => (
                            <Card identifier={card.identifier} className={card.class} image={card.image} style={card.style}/>
                        ))}
                    </section>
                </div>
            </div>
        </div>
    );
};

export default Greeting;