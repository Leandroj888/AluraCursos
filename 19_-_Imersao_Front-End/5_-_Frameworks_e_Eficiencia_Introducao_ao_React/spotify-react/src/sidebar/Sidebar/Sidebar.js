import React from "react";

import "./Sidebar.css";
import Library from '../Library/Library';
import Navigation from '../Navigation/Navigation';

/* eslint-disable jsx-a11y/anchor-is-valid */
const Sidebar = () => {
    return (
        <div className="sidebar">
            <Navigation />
            <Library />
        </div>
    );
}

export default Sidebar;