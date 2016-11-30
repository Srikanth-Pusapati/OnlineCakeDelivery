package tests;

import static org.testng.Assert.fail;

import java.util.concurrent.TimeUnit;

import org.openqa.selenium.Alert;
import org.openqa.selenium.By;
import org.openqa.selenium.NoAlertPresentException;
import org.openqa.selenium.NoSuchElementException;
import org.openqa.selenium.WebDriver;
import org.openqa.selenium.chrome.ChromeDriver;
import org.openqa.selenium.support.ui.ExpectedConditions;
import org.openqa.selenium.support.ui.Select;
import org.openqa.selenium.support.ui.WebDriverWait;
import org.testng.annotations.AfterClass;
import org.testng.annotations.BeforeClass;
import org.testng.annotations.Test;

public class CustomerOrder {
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




		driver.manage().timeouts().implicitlyWait(30, TimeUnit.SECONDS);
	}

	@Test
	public void testCustomerOrder() throws Exception {
		driver.get(baseUrl + "/OnlineCakeDelivery/Source/Code/src/index.php");
		driver.findElement(By.linkText("My Account")).click();
		driver.findElement(By.name("userEmail")).clear();
		driver.findElement(By.name("userEmail")).sendKeys("ashik@gmail.com");
		driver.findElement(By.name("userPassword")).clear();
		driver.findElement(By.name("userPassword")).sendKeys("Ashik@123");
		driver.findElement(By.id("login_button")).click();
		driver.findElement(By.xpath("/html/body/div[2]/div/ul/li/figure/a[1]/img")).click();

		WebDriverWait wait = new WebDriverWait(driver, 5);
		wait.until(ExpectedConditions.visibilityOfElementLocated(By.xpath("/html/body/div[2]/div/ul/li/figure/a[1]/img")));
		driver.findElement(By.linkText("Shippping Address")).click();
		driver.findElement(By.name("Date_Of_Delivery")).clear();
		driver.findElement(By.name("Date_Of_Delivery")).sendKeys("12/12/2016");
		driver.findElement(By.name("Time_Of_Delivery")).clear();
		driver.findElement(By.name("Time_Of_Delivery")).sendKeys("08:00pm");
		driver.findElement(By.name("Email_Address")).clear();
		driver.findElement(By.name("Email_Address")).sendKeys("ashik.yds@gmail.com");
		driver.findElement(By.name("Phone")).clear();
		driver.findElement(By.name("Phone")).sendKeys("9407459409");
		driver.findElement(By.name("Address")).clear();
		driver.findElement(By.name("Address")).sendKeys("bernard street \napt 3");
		new Select(driver.findElement(By.name("country"))).selectByVisibleText("USA");
		driver.findElement(By.name("city")).clear();
		driver.findElement(By.name("city")).sendKeys("denton");
		driver.findElement(By.name("zip")).clear();
		driver.findElement(By.name("zip")).sendKeys("76201");
		driver.findElement(By.name("submit")).click();
		driver.findElement(By.id("UI_rating")).click();
		driver.findElement(By.id("cake_available")).click();
		driver.findElement(By.id("suggest")).click();
		driver.findElement(By.id("worth")).click();
		driver.findElement(By.id("comment")).clear();
		driver.findElement(By.id("comment")).sendKeys("Good Site worth shopping");
		driver.findElement(By.name("submit")).click();
		driver.findElement(By.linkText("Logout")).click();
	}	

	@AfterClass(alwaysRun=true)
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
