# ADR-007

## Title

Confidence Is A Framework

---

## Status

Accepted

---

## Date

2026-07-14

---

## Context

Confidence was initially considered part of Evidence Theory.

Further architectural review demonstrated that confidence estimation is a reusable capability across multiple components.

Confidence therefore represents a framework rather than an isolated theoretical concept.

---

## Decision

Confidence is defined as an architectural framework.

Its purpose is to estimate the strength of available justification.

Confidence depends upon Evidence.

Evidence never depends upon Confidence.

---

## Rationale

Separating Confidence from individual theories enables consistent trust estimation throughout SchoolOS.

Future engines may estimate confidence for Patterns, Insights, Recommendations and AI outputs.

---

## Consequences

A dedicated Confidence Framework will be developed.

Evidence remains responsible for justification.

Confidence remains responsible for trust estimation.

---

## Alternatives Considered

### Confidence belongs to Evidence Theory.

Rejected because confidence is reusable across multiple architectural layers.

---

## Related Documents

- EVIDENCE_THEORY.md
- INSIGHT_THEORY.md

---

## Notes

Confidence measures trust.

It never creates knowledge.