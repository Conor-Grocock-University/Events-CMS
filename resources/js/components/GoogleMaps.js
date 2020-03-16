import React, { Component } from "react";
import ReactDOM from "react-dom";

import { Map, GoogleApiWrapper } from "google-maps-react";

const mapStyles = {
    width: "100%",
    height: "100%"
};

export class MapContainer extends Component {
    render() {
        return (
            <Map
                google={this.props.google}
                zoom={14}
                style={mapStyles}
                initialCenter={{
                    lat: -1.2884,
                    lng: 36.8233
                }}
            />
        );
    }
}

export default GoogleApiWrapper({
    apiKey: "AIzaSyBkLGoWEiu2GicrgPCEJi2_S53JN6-Xm2Q"
})(MapContainer);

if (document.getElementById("google-maps")) {
    ReactDOM.render(<MapContainer />, document.getElementById("google-maps"));
}
