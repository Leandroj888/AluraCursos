import React from "react";
import "./Artist.css";

/* eslint-disable jsx-a11y/anchor-is-valid */
/* eslint-disable jsx-a11y/alt-text */
const Artist = () => {
    return (
        <div id="result-artist" className="hidden">
            <div className="grid-container">
                <div className="artist-card" id="">
                    <div className="card-img">
                        <img id="artist-img" className="artist-img" />
                        <div className="play">
                            <span className="fa fa-solid fa-play"></span>
                        </div>
                    </div>
                    <div className="card-text">
                            <a title="Foo Fighters" className="vst" href=""></a>
                            <span className="artist-name" id="artist-name"></span>
                            <span className="artist-categorie">Artista</span>
                    </div>
                </div>
            </div>
        </div>
    );
};

export default Artist;