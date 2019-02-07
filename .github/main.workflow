workflow "CI/CD" {
  resolves = [
    "Hyper Lazer Deployer Prod",
    "Hyper Lazer Deployer Dev",
  ]
  on = "push"
}

action "branch-filter" {
  uses = "actions/bin/filter@master"
  args = "branch master"
}

action "branch-filter-dev" {
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
