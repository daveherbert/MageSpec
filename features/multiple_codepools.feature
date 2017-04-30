Feature: Multiple Code Pool Support
  In order to support multiple Magento code pools
  As a developer
  I want Magespec to allow me to use multiple code pools

  Scenario: User has not defined a code pool
    Given that there is no code pool defined in config
    And my module namespace is "Behat_Test"
    When the user describes a Magento object
    Then the user will be prompted to select a target code pool
    And the spec will be created in the selected code pool

  Scenario: User's code pool choice is remembered
    Given that there is no code pool defined in config
    And the user describes a Magento object
    And selects "local" as the target code pool
    When the user describes a second Magento object
    Then the user will be offered "local" as the default choice of code pool

  Scenario: User has defined a code pool in config
    Given that "local" is configured as the default code pool
    When the user describes a Magento object
    Then the spec will be created in the "local" pool

  Scenario: User overrides the default code pool
    Given that "local" is configured as the default code pool
    When the user describes a Magento object
    And sets the codepool flag to "community"
    Then the spec will be created in the "community" pool

  Scenario: User may not target the core code pool from config
    Given that "core" is configured as the default code pool
    When the user describes a Magento object
    Then they will see an illegal code pool error

  Scenario: User may not target the core code pool from override
    Given that "local" is configured as the default code pool
    When the user describes a Magento object
    And sets the codepool flag to "core"
    Then they will see an illegal code pool error

  Scenario: User can run specs from all code pools
    Given that there is a "local" code pool spec
    And there is a "community" code pool spec
    When the user calls the run command with no path
    Then all the specs will be executed

  Scenario: User can run specs from a single code pool
    Given that there is a "local" code pool spec
    And there is a "community" code pool spec
    When the user calls the run command with the community code pool path
    Then only the community spec will be executed