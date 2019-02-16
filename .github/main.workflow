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
