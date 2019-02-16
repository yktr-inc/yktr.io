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
