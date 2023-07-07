export const homeSetup = (test) => {
    test.beforeEach(async ({ page }) => {
        await page.goto('http://localhost:80');
    });
}
