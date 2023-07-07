// @ts-check
const { test, expect } = require('@playwright/test');
const {mobileSetup} = require("../../mobile-setup");
const {registerSetup} = require("./register-setup");

mobileSetup(test);
registerSetup(test);

test('has title', async ({ page }) => {
    await expect(page)
        .toHaveTitle(/Register - Robot Riffs|Robot Riffs/);
});

test('allows creation of user accounts', async ({ page }) => {
    await page.getByLabel('Name').click();
    await page.getByLabel('Name').fill('Test User');
    await page.getByLabel('Handle').click();
    await page.getByLabel('Handle').fill('testuser');
    await page.getByLabel('Email').click();
    await page.getByLabel('Email').fill('test@example.com');
    await page.getByLabel('Email').press('Tab');
    await page.getByLabel('Password', { exact: true }).fill('password');
    await page.getByLabel('Confirm Password').fill('password');
    await page.getByRole('button', { name: 'Register' }).click();
    await page.getByRole('link', { name: 'Profile' }).click();
    await expect(page).toHaveURL(/.*testuser/)
});
