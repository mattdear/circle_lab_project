<?php
session_start();
include("../OOP/WebPage.php");
include("functions.php");
if (!isset ($_SESSION["gatekeeper"])) {
    popUpError("Your not logged in! Please log in and try again.");
} else {
    $webPage = new WebPage("Add Appointment", "Circle Lab", 2020);
    $webPage->open();
    $webPage->setCSS("../css/smart-system");
    $webPage->writeHead();
    $todayMin = date("d/m/Y");
    ?>
    <h1>Add Appointment</h1>
    <form method="post" action="appointments.php">
        <div class="row">
            <div class="col-25">
                <label>Description</label>
            </div>
            <div class="col-75">
                <input class="inputs" name="description" placeholder="Description">
            </div>
        </div>
        <div class="row">
            <div class="col-25">
                <label>Patient</label>
            </div>
            <div class="col-75">
                <input class="inputs" name="patient" placeholder="Patient">
            </div>
        </div>
        <div class="row">
            <div class="col-25">
                <label>Doctor</label>
            </div>
            <div class="col-75">
                <input class="inputs" name="doctor" placeholder="Doctor">
            </div>
        </div>
        <div class="row">
            <div class="col-25">
                <label>Date</label>
            </div>
            <div class="col-75">
                <input class="inputs" name="date" placeholder="dd/mm/yyyy" type="date" min='<?= $todayMin ?>'>
            </div>
        </div>
        <div class="row">
            <div class="col-25">
                <label>Location</label>
            </div>
            <div class="col-75">
                <select class="inputs, select" name="location">
                    <option value="city">City</option>
                    <option value="town">Town</option>
                    <option value="hill">Hill</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-25">
                <label>Duration</label>
            </div>
            <div class="col-75">
                <select class="inputs, select" name="duration">
                    <option value="15">15 Minutes</option>
                    <option value="30">30 Minutes</option>
                    <option value="45">45 Minutes</option>
                    <option value="60">60 Minutes</option>
                </select>
            </div>
        </div>
        <button type="submit">Add</button>
    </form>
    <button onclick="window.location.href = 'appointments.php';">Back</button>
    <br/>
    <button onclick="window.location.href = 'homepage.php';">Homepage</button>
    <br/>
    <?php
    $webPage->writeFooter();
    $webPage->close();
}
