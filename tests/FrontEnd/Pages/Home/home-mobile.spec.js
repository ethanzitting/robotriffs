// @ts-check
const { test, expect } = require('@playwright/test');
const {mobileSetup} = require("../../mobile-setup");
const {homeSetup} = require("./home-setup");

mobileSetup(test)
homeSetup(test)

test('has title', async ({ page }) => {
    await expect(page)
        .toHaveTitle(/Explore - Robot Riffs|Robot Riffs/);
});

test('provides valid link to register', async ({ page }) => {
    await page.getByRole('link', { name: 'Register' })
        .click();

    await expect(page).toHaveURL(/.*register/)
});
