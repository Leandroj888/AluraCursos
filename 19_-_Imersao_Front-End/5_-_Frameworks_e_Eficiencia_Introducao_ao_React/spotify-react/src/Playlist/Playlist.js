/* eslint-disable jsx-a11y/anchor-is-valid */
/* eslint-disable jsx-a11y/alt-text */
import React from "react";
import "./Playlist.css";
import Artist from "../Artist/Artist";

import img1 from "../assets/playlist/1.jpeg";
import img2 from "../assets/playlist/2.png";
import img3 from "../assets/playlist/3.jpeg";
import img4 from "../assets/playlist/4.jpeg";
import img5 from "../assets/playlist/5.jpeg";
import img6 from "../assets/playlist/6.jpeg";
import img7 from "../assets/playlist/7.jpeg";
import img8 from "../assets/playlist/8.jpeg";
import img9 from "../assets/playlist/9.jpeg";
import img10 from "../assets/playlist/10.jpeg";
import img11 from "../assets/playlist/11.jpeg";
import img12 from "../assets/playlist/12.jpeg";
import img13 from "../assets/playlist/13.jpeg";
import img14 from "../assets/playlist/14.jpeg";
import img15 from "../assets/playlist/15.jpeg";


const cards = [
    { class: "cards card1", image:img1, style:"Boas festas"},
    { class: "cards card2", image:img2, style:"Feitos para você"},
    { class: "cards card3", image:img3, style:"Lançamentos"},
    { class: "cards card4", image:img4, style:"Creators"},
    { class: "cards card5", image:img5, style:"Para treinar"},
    { class: "cards card6", image:img6, style:"Podcasts"},
    { class: "cards card7", image:img7, style:"Sertanejo"},
    { class: "cards card8", image:img8, style:"Samba e pagode"},
    { class: "cards card9", image:img9, style:"Funk"},
    { class: "cards card10", image:img10, style:"MPB"},
    { class: "cards card11", image:img11, style:"Rock"},
    { class: "cards card12", image:img12, style:"Hip Hop"},
    { class: "cards card13", image:img13, style:"Indie"},
    { class: "cards card14", image:img14, style:"Relax"},
    { class: "cards card15", image:img15, style:"Música Latina"}
];

const Playlist = () => {
    return (
        <div className="playlist-container">
            <div id="result-playlists">
                <div className="playlist">
                    {/* COLOCAR O BOM DIA | BOA TARDE | BOA NOITE */}
                    <h1 id="greeting">Boa noite</h1>
                    <h2 className="session">Navegar por todas as seções</h2>
                </div>
                <div className="offer__scroll-container">
                    <div className="offer__list">
                        <section className="offer__list-item">
                            {cards.map((card, index) => (
                                <a href="" className="cards">
                                    <div className={card.class}>
                                        <img src={card.image} alt="" />
                                        <span>{card.style}</span>
                                    </div>
                                </a>
                            ))}
                        </section>
                    </div>
                </div>
            </div>
            <Artist/>
        </div>
    );
};

export default Playlist;