import React from "react";
import InteractiveWeather from "../components/InteractiveWeather";
import NavigationBar from "../components/NavigationBar";

export default function Home() {
    return (
        <React.Fragment>
            <NavigationBar />
            {/* body */}
            <div className="m-10">
                <InteractiveWeather />
            </div>
        </React.Fragment>
    );
}
