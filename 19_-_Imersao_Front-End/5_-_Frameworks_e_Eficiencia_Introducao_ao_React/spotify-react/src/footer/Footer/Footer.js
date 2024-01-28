import React from "react";
import MenuButton from "../../util/MenuButton/MenuButton";
import "./Footer.css";

const Footer = () => {
    return (
        <footer className="disclaimer-premium">
            <div className="disclaimer-premium__content">
                <div className="text">
                    <p className="disclaimer-premium__title">Testar o Premium de graça</p>
                    <p className="disclaimer-premium__subtitle">
                        Inscreva-se para curtir música ilimitada e podcasts só com alguns
                        anúncios. Não precisa de cartão de crédito.
                    </p>
                </div>
                <MenuButton classButton="footer__button" text="Inscreva-se grátis" />
            </div>
        </footer>
    );
};

export default Footer;