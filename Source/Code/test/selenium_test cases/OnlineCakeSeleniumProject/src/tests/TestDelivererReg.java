package tests;

import static org.testng.Assert.fail;

import java.util.concurrent.TimeUnit;

import org.openqa.selenium.Alert;
import org.openqa.selenium.By;
import org.openqa.selenium.NoAlertPresentException;
import org.openqa.selenium.NoSuchElementException;
import org.openqa.selenium.WebDriver;
import org.openqa.selenium.chrome.ChromeDriver;
import org.openqa.selenium.support.ui.Select;
import org.testng.annotations.AfterClass;
import org.testng.annotations.BeforeClass;
import org.testng.annotations.Test;

public class TestDelivererReg {
  private WebDriver driver;
  private String baseUrl;
  private boolean acceptNextAlert = true;
  private StringBuffer verificationErrors = new StringBuffer();

  @BeforeClass(alwaysRun = true)
  public void setUp() throws Exception {
	  System.setProperty("webdriver.chrome.driver", "C:\\xampp\\htdocs\\OnlineCakeDelivery\\Source\\Code\\chromedriver.exe");
		driver = new ChromeDriver();
		baseUrl = "http://localhost";
    driver.manage().timeouts().implicitlyWait(30, TimeUnit.SECONDS);
  }

  @Test
  public void testDelivererReg() throws Exception {
    driver.get(baseUrl + "/OnlineCakeDelivery/Source/Code/src/index.php");
    driver.findElement(By.linkText("Registration")).click();
    driver.findElement(By.name("uname")).clear();
    driver.findElement(By.name("uname")).sendKeys("srikanth");
    driver.findElement(By.name("email")).clear();
    driver.findElement(By.name("email")).sendKeys("srikanth@gmail.com");
    driver.findElement(By.name("address")).clear();
    driver.findElement(By.name("address")).sendKeys("911 Bernard St, #3, Denton, Texas, 76201.");
    driver.findElement(By.name("pwd")).clear();
    driver.findElement(By.name("pwd")).sendKeys("Sri@1994");
    driver.findElement(By.name("mobile")).clear();
    driver.findElement(By.name("mobile")).sendKeys("9407459409");
    new Select(driver.findElement(By.name("type"))).selectByVisibleText("Deliverer");
    driver.findElement(By.id("submit")).click();
    driver.findElement(By.linkText("Logout")).click();
  }

  @AfterClass
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
