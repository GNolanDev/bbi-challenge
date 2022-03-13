import React from "react";
import ReactDOM from "react-dom";
import App from "./App";

// use mock service worker if in development environment to test API calls
/* note - all running on local machine is in this environment, so comment this
 * out to run full end to end test of Laravel and React */
if (process.env.NODE_ENV === "development") {
    const { worker } = require("../../src/mocks/browser");
    worker.start();
}

ReactDOM.render(
    <React.StrictMode>
        <App />
    </React.StrictMode>,
    document.getElementById("App")
);
