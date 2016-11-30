package tests;

import static org.testng.Assert.fail;

import java.util.concurrent.TimeUnit;

import org.openqa.selenium.Alert;
import org.openqa.selenium.By;
import org.openqa.selenium.NoAlertPresentException;
import org.openqa.selenium.NoSuchElementException;
import org.openqa.selenium.WebDriver;
import org.openqa.selenium.chrome.ChromeDriver;
import org.openqa.selenium.firefox.FirefoxDriver;
import org.openqa.selenium.support.ui.Select;
import org.testng.annotations.AfterClass;
import org.testng.annotations.BeforeClass;
import org.testng.annotations.Test;

public class AdminViewfeedback {
	private WebDriver driver;
	private String baseUrl;
	private boolean acceptNextAlert = true;
	private StringBuffer verificationErrors = new StringBuffer();

	@BeforeClass(alwaysRun = true)
	public void setUp() throws Exception {
		System.setProperty("webdriver.chrome.driver",
				"C:\\xampp\\htdocs\\OnlineCakeDelivery\\Source\\Code\\chromedriver.exe");
		driver = new ChromeDriver();
		baseUrl = "http://localhost";
		driver.manage().timeouts().implicitlyWait(40, TimeUnit.SECONDS);
	}

	@Test
	public void testAdminViewfeedback() throws Exception {
		driver.get(baseUrl + "/OnlineCakeDelivery/Source/Code/src/index.php");
		driver.findElement(By.linkText("My Account")).click();
		driver.findElement(By.name("userEmail")).clear();
		driver.findElement(By.name("userEmail")).sendKeys("admin@test.com");
		driver.findElement(By.name("userPassword")).clear();
		driver.findElement(By.name("userPassword")).sendKeys("Admin@123");
		new Select(driver.findElement(By.name("userType"))).selectByVisibleText("Admin");
		driver.findElement(By.id("login_button")).click();
		driver.findElement(By.id("litotab2")).click();
		Thread.sleep(5000);
		driver.findElement(By.linkText("Logout")).click();


	}

	@AfterClass(alwaysRun = true)
	public void tearDown() throws Exception {
		driver.quit();
		String verificationErrorString = verificationErrors.toString();
		if (!"".equals(verificationErrorString)) {
			fail(verificationErrorString);
		}
	}

	private boolean isElementPresent(By by) {
		try {
			driver.findElement(by);
			return true;
		} catch (NoSuchElementException e) {
			return false;
		}
	}

	private boolean isAlertPresent() {
		try {
			driver.switchTo().alert();
			return true;
		} catch (NoAlertPresentException e) {
			return false;
		}
	}

	private String closeAlertAndGetItsText() {
		try {
			Alert alert = driver.switchTo().alert();
			String alertText = alert.getText();
			if (acceptNextAlert) {
				alert.accept();
			} else {
				alert.dismiss();
			}
			return alertText;
		} finally {
			acceptNextAlert = true;
		}
	}
}
