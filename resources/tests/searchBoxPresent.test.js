/* test to set up React UI and check for presence of Search Box
 * without the need for the Laravel Back End to be functional */

import { render, screen } from "@testing-library/react";
import "@testing-library/jest-dom";
import React from "react";
import App from "../js/app";

test("react dom basic test", () => {
    render(<App />);
    const searchboxElement = screen.getByPlaceholderText(/Search term/);
    expect(searchboxElement).toBeInTheDocument();
});
