package com.example.tests;

import java.util.regex.Pattern;
import java.util.concurrent.TimeUnit;
import org.junit.*;
import static org.junit.Assert.*;
import static org.hamcrest.CoreMatchers.*;
import org.openqa.selenium.*;
import org.openqa.selenium.firefox.FirefoxDriver;
import org.openqa.selenium.support.ui.Select;

public class CustomerOrder {
  private WebDriver driver;
  private String baseUrl;
  private boolean acceptNextAlert = true;
  private StringBuffer verificationErrors = new StringBuffer();

  @Before
  public void setUp() throws Exception {
    driver = new FirefoxDriver();
    baseUrl = "http://localhost/src/index.php";
    driver.manage().timeouts().implicitlyWait(30, TimeUnit.SECONDS);
  }

  @Test
  public void testCustomerOrder() throws Exception {
    driver.get(baseUrl + "/OnlineCakeDelivery/Source/Code/src/index.php");
    driver.findElement(By.linkText("My Account")).click();
    driver.findElement(By.name("userEmail")).clear();
    driver.findElement(By.name("userEmail")).sendKeys("anvesh@gmail.com");
    driver.findElement(By.name("userPassword")).clear();
    driver.findElement(By.name("userPassword")).sendKeys("Anvesh@1994");
    driver.findElement(By.id("login_button")).click();
    driver.findElement(By.linkText("Order")).click();
    driver.findElement(By.linkText("Shippping Address")).click();
    driver.findElement(By.name("Date_Of_Delivery")).clear();
    driver.findElement(By.name("Date_Of_Delivery")).sendKeys("12/12/2016");
    driver.findElement(By.name("Time_Of_Delivery")).clear();
    driver.findElement(By.name("Time_Of_Delivery")).sendKeys("08:00pm");
    driver.findElement(By.name("Email_Address")).clear();
    driver.findElement(By.name("Email_Address")).sendKeys("ashik.yds@gmail.com");
    driver.findElement(By.name("Phone")).clear();
    driver.findElement(By.name("Phone")).sendKeys("5128930103");
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
    driver.findElement(By.id("comment")).sendKeys("nothing");
    driver.findElement(By.name("submit")).click();
    driver.findElement(By.linkText("Logout")).click();
  }

  @After
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
