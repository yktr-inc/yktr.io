workflow "CI/CD" {
  resolves = [
    "Hyper Lazer Deployer Prod",
    "Hyper Lazer Deployer Dev",
     "PHPStan",
    "PHP-CS-Fixer",
    "Psalm",
    "PHPQA"
  ]
  on = "push"
}

action "PHPStan" {
  uses = "docker://oskarstark/phpstan-ga:with-extensions"
  args = "analyse src tests --level max --configuration extension.neon"
  secrets = ["GITHUB_TOKEN"]
}

action "PHP-CS-Fixer" {
  uses = "docker://oskarstark/php-cs-fixer-ga"
  secrets = ["GITHUB_TOKEN"]
  args = "--config=.php_cs --diff --dry-run"
}

action "Psalm" {
  needs="PHPStan"
  uses = "docker://mickaelandrieu/psalm-ga"
  secrets = ["GITHUB_TOKEN"]
  args = "--find-dead-code --diff --diff-methods"
}

action "PHPQA" {
  needs="PHP-CS-Fixer"
  uses = "docker://mickaelandrieu/phpqa-ga"
  secrets = ["GITHUB_TOKEN"]
  args = "--report --tools phpcs:0,phpmd:0,phpcpd:0,parallel-lint:0,phpmetrics,phploc,pdepend --ignoredDirs vendor"
}


action "branch-filter" {
  needs = ["Psalm", "PHPQA"]
  uses = "actions/bin/filter@master"
  args = "branch master"
}


action "branch-filter-dev" {
  needs = ["Psalm", "PHPQA"]
  uses = "actions/bin/filter@master"
  args = "branch develop"
}

action "Hyper Lazer Deployer Dev" {
  needs = "branch-filter-dev"
  uses = "docker://louishrg/hyper-lazer-deployer:1.0"
  secrets = ["RSA_PRIV", "RSA_PUB", "REMOTE", "AFTER_PULL_COMMAND", "GITHUB_TOKEN"]
  env = {
    TARGET_FOLDER = "/home/yktr/dev.yktr.io"
    REPO_GIT_URL = "-b develop git@github.com:yktr-inc/yktr.io.git"
  }
}


action "Hyper Lazer Deployer Prod" {
  needs = "branch-filter"
  uses = "docker://louishrg/hyper-lazer-deployer:1.0"
  secrets = [
    "REMOTE",
    "TARGET_FOLDER",
    "REPO_GIT_URL",
    "AFTER_PULL_COMMAND",
    "GITHUB_TOKEN",
    "RSA_PRIV",
    "RSA_PUB",
  ]
}
