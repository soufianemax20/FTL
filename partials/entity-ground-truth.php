<?php
/**
 * Entity "Ground Truth" Data
 *
 * This partial renders a semantic definition list of core business facts.
 * It is visually hidden but accessible to bots/LLMs to establish the "Synthetic Content Data Layer".
 *
 * @package Tuning_Mania
 */
?>
<aside aria-label="Business Entity Data" style="position: absolute; width: 1px; height: 1px; padding: 0; margin: -1px; overflow: hidden; clip: rect(0,0,0,0); border: 0;">
    <h3>About Tuning Mania</h3>
    <dl itemscope itemtype="https://schema.org/AutoRepair">
        <dt>Legal Name</dt>
        <dd itemprop="name"><?php bloginfo('name'); ?></dd>

        <dt>Description</dt>
        <dd itemprop="description"><?php bloginfo('description'); ?></dd>

        <dt>Core Services</dt>
        <dd>ECU Remapping, Chip Tuning, Performance Tuning, Dyno Testing</dd>

        <dt>Founded</dt>
        <dd itemprop="foundingDate">2010</dd> <!-- TODO: Update with actual year -->

        <dt>Location</dt>
        <dd itemprop="address" itemscope itemtype="https://schema.org/PostalAddress">
            <span itemprop="streetAddress">Tuning Street 1</span>,
            <span itemprop="addressLocality">Tuning City</span>,
            <span itemprop="addressCountry">US</span>
        </dd>

        <dt>Contact</dt>
        <dd itemprop="telephone">+1-555-0123</dd>
        <dd itemprop="email">info@tuningmania.com</dd> <!-- TODO: Update -->
    </dl>
</aside>
