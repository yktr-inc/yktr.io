workflow "Deploy prod" {
  resolves = [
    "Hyper Lazer Deployer Prod",
  ]
  on = "push"
}

action "branch-filter" {
  uses = "actions/bin/filter@master"
  args = "branch release"
}

action "Hyper Lazer Deployer Prod" {
  needs = "branch-filter"
  uses = "docker://louishrg/hyper-lazer-deployer:1.0"
  secrets = [
    "REMOTE",
    "GITHUB_TOKEN",
    "RSA_PRIV",
    "RSA_PUB",
  ]
  env = {
    TARGET_FOLDER = "/home/yktr/yktr.io"
    REPO_GIT_URL = "-b release git@github.com:yktr-inc/yktr.io.git"
    AFTER_PULL_COMMAND = "sh /home/deployers/yktr-prod.sh"
  }
}

workflow "Deploy dev" {
  resolves = [
    "Hyper Lazer Deployer Dev",
  ]
  on = "push"
}

action "branch-filter-dev" {
  uses = "actions/bin/filter@master"
  args = "branch wip"
}

action "Hyper Lazer Deployer Dev" {
  needs = "branch-filter-dev"
  uses = "docker://louishrg/hyper-lazer-deployer:1.0"
  secrets = ["RSA_PRIV", "RSA_PUB", "REMOTE", "GITHUB_TOKEN"]
  env = {
    TARGET_FOLDER = "/home/yktr/dev.yktr.io"
    REPO_GIT_URL = "-b wip git@github.com:yktr-inc/yktr.io.git"
    AFTER_PULL_COMMAND = "sh /home/deployers/yktr-dev.sh"
  }
}

workflow "Code Quality" {
  on = "push"
  resolves = ["PHP Spec"]
}

action "PHP-CS-Fixer" {
  uses = "docker://oskarstark/php-cs-fixer-ga"
  args = "--config=.php_cs"
}

action "PHP Spec" {
  uses = "docker://phpspec/phpspec"
  needs = ["PHP-CS-Fixer"]
  args = "--config=phpspec.yml"
}
