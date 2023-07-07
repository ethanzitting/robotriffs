export const registerSetup = (test) => {
    test.beforeEach(async ({ page }) => {
        await page.goto('http://localhost:80/register');
    });
}
